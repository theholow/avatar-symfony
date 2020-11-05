<?php

namespace App\Services\Avatar;

use App\Services\Helper\ColorTools;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

/**
 * Class SvgPixelAvatarFactory
 * Usine à fabriquer des avatars
 */
class SvgAvatarFactory extends AbstractController
{

    /**
     * @var SvgMatrixRenderer
     */
    private $renderer;

    public function __construct(SvgMatrixRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param int $size La taille de l'avatar
     * @param int $numberOfColors Le nombre de couleurs différentes de l'avatar
     * @return AvatarMatrix
     */
    public function getRandomMatrix(int $size = 5, int $numberOfColors = 2): AvatarMatrix
    {
        // Création d'un objet SvgMatrixRenderer, en paramètre du constructeur le chemin vers le fichier de template SVG;

        // Création de la matrice de l'avatar avec injection de l'objet Moteur de rendu
        $matrix = new AvatarMatrix($this->renderer);
        $matrix->setSize($size);

        // Génération d'un tableau de couleurs aléatoires
        $colors = array_map(function () {
            return ColorTools::getRandomColor();
        }, array_fill(0, $numberOfColors, null));

        $matrix->setColors($colors);

        return $matrix;
    }
}