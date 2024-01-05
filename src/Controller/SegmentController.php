<?php

namespace App\Controller;

use DateTime;

use Webapp\Controller\WebappController;
use App\Form\SegmentType;
use App\Form\SegmentCreateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Segment;
use Domain\Entity\Restaurant;


class SegmentController extends WebappController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    public function listSegments()
    {
        $segmentos = $this->getDoctrine()->getRepository(Segment::class)->findAll();

        return $this->viewRender('segment-list.html.twig', [
            'segmentos' => $segmentos,
        ]);
    }

    public function showSegmentDetails($id)
    {
        $segmento = $this->getDoctrine()->getRepository(Segment::class)->find($id);

        return $this->viewRender('segment-details.html.twig', [
            'segmento' => $segmento,
        ]);
    }

    public function editSegment(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $segment = $entityManager->getRepository(Segment::class)->find($id);

        if (!$segment) {
            throw $this->createNotFoundException('No se encontró el segmento con el ID: '.$id);
        }


        $form = $this->createForm(SegmentType::class, $segment, []);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'delete' === $form->getClickedButton()->getName()) {
            $entityManager->remove($segment);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }



        return $this->viewRender('edit-segment.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createSegment(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $segment = new Segment();

        $form = $this->createForm(SegmentCreateType::class, $segment, []);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $segment->setUidentifier(uniqid());
            $segment->setCreatedAt(new \DateTime());

            $entityManager->persist($segment);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->viewRender('create-segment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
