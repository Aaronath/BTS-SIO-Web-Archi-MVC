<?php

namespace Quizz\Controller;

use Quizz\Model\QuestionnaireModel;
use Quizz\Service\TwigService;

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
        $twig = TwigService::getEnvironment();

        echo $twig->render('home/hello.html.twig', [
            'param' => $this->param
        ]);
    }
}