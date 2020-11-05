<?php

namespace App\Services\Avatar;

use App\Services\Helper\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SvgMatrixRenderer implements AvatarRendererInterface
{

    /**
     * @var string $template le chemin vers le fichier de template
     */
    private $template;


    /**
     * @var string $twig
     */
    private $twig;

    /**
     * SvgMatrixRenderer constructor.
     * @param string $template Le chemin vers le fichier de template
     * @param Environment $twig
     */
    public function __construct(Environment $twig, string $template)
    {
        $this->template = $template;
        $this->twig = $twig;
    }



    /**
     * @param AvatarMatrixInterface $matrix
     * @return string Le code SVG de l'avatar
     *
     */
    public function render(AvatarMatrixInterface $matrix): string
    {

        // Initialisation de la taille de l'image, de la couleur de fond et de la couleur
        $size = $matrix->getSize();
        $grid = $matrix->getRandom();

        return $this->twig->render($this->template, [
            'size' => $size,
            'grid' => $grid
        ]);
    }
}