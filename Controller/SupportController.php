<?php

namespace Alpixel\Bundle\CustomerBridgeBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class SupportController extends CRUDController
{

    const MAX_ELEMENTS_PER_PAGE = 100;

    public function listAction(Request $request = NULL)
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $bridge = $this->get('alpixel.customer_bridge.helper.bridge')->getAPI();
        $result = $bridge->getJiraTickets();
        $issues = $result['data']['issues'];

    //     $entities = [];
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $meta = $entityManager->getMetadataFactory()->getAllMetadata();

    //     foreach ($meta as $m) {
    //         $inClass = in_array('Alpixel\\Bundle\\SEOBundle\\Entity\\SluggableTrait', class_uses($m->getName()));
    //         $hasInterface = in_array('Alpixel\\Bundle\\SEOBundle\\Entity\\SluggableInterface', class_implements($m->getName()));
    //         if ($inClass || $hasInterface) {
    //             $entities[] = $m->getName();
    //         }
    //     }

    //     $page = (int) $this->get('request')->query->get('page');

    //     if ($page <= 0) {
    //         $page = 1;
    //     }

    //     $previous = 1;
    //     $next = 2;

    //     if ($page > $previous) {
    //         $previous = $page - 1;
    //     }

    //     if ($page >= $next) {
    //         $next = $page + 1;
    //     }

    //     $objects = [];
    //     foreach ($entities as $entity) {
    //         $founds = $entityManager
    //                     ->getRepository($entity)
    //                     ->createQueryBuilder('e')
    //                     ->setFirstResult(($page - 1) * self::MAX_ELEMENTS_PER_PAGE)
    //                     ->setMaxResults(self::MAX_ELEMENTS_PER_PAGE)
    //                     ->getQuery()
    //                     ->getResult();
    //         foreach ($founds as $found) {
    //             $objects[] = $found;
    //         }
    //     }

    //     $form = $this->createForm(new SlugForm($objects));
    //     $request = $this->get('request');

    //     if ($request->getMethod() == 'POST') {
    //         $form->bind($request);

    //         if ($form->isValid()) {
    //             foreach ($objects as $object) {
    //                 $oldSlug = $object->getSlug();
    //                 $newSlug = $form->get('slug_'.md5(get_class($object).$object->getId()))->getData();

    //                 if ($oldSlug !== $newSlug) {
    //                     $object->setSlug($newSlug);
    //                     $entityManager->persist($object);
    //                 }
    //             }
    //             $entityManager->flush();
    //             $this->addFlash(
    //                 'sonata_flash_success',
    //                 $this->admin->trans(
    //                     'Modifications enregistrées'
    //                 )
    //             );
    //         }
    //     }

        return $this->render('AlpixelCustomerBridgeBundle:page:support_list.html.twig', [
            'action'     => 'list',
            'objects'    => $issues,
            // 'form'       => $form->createView(),
            // 'pagination' => [$previous, $next],
        ], null, $request);
    }
}
