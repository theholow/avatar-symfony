<?php

namespace App\Controller;

use App\Services\Avatar\SvgAvatarFactory;
use App\Services\Helper\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Avatar\SvgMatrixRenderer;


class AvatarController extends AbstractController
{


    private $default_size = 5;
    private $default_value = 3;


    /**
     *  @Route("/index/{size<\d+>}/{colors<\d+>}", name="avatar.index")
     * @param Request $request
     * @param SvgAvatarFactory $svgAvatarFactory
     * @param  $size
     * @param  $colors
     * @return Response
     */
    public function index(Request $request, SvgAvatarFactory $svgAvatarFactory, $size = 5, $colors = 7): Response
    {
        /* dump($request->request->get('size'));
         dump($request->request->get('colors'));*/


        $size = $request->request->get('size') ?? $size;
        $colors = $request->request->get('colors') ?? $colors;

        $svg = $svgAvatarFactory
            ->getRandomMatrix($size, $colors)
            ->render();

        return $this->render('avatar/index.html.twig', [
            'svg' => $svg
        ]);
    }

    /**
     * @Route ("/index/save", name="avatar.save")
     * @param Request $request
     * @param FileSystemHelper $fileSystemHelper
     * @return RedirectResponse
     */
    public function save(Request $request, FileSystemHelper $fileSystemHelper): RedirectResponse
    {
        $svg = $request->request->get('svg');

        $filename = $fileSystemHelper->saveAvatar($svg);

        return $this->redirectToRoute('avatar.index');

    }

}