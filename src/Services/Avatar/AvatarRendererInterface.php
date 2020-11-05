<?php

namespace App\Services\Avatar;

interface AvatarRendererInterface {

    public function render(AvatarMatrixInterface $matrix);
}