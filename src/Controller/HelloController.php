<?php

namespace Quizz\Controller;

use Quizz\Core\View\TwigCore;
use Quizz\Model\QuestionnaireModel;

class HelloController implements \Quizz\Core\Controller\ControllerInterface
{
    private $param;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->param = $tabInput["VARS"]["id"];
        }
    }

    public function outputEvent()
    {
        $twig = TwigCore::getEnvironment();

        echo $twig->render('home/hello.html.twig', [
            'param' => $this->param
        ]);
    }
}