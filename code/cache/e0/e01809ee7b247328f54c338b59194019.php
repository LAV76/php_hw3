<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* header.tpl */
class __TwigTemplate_9250eff3e7c45143a2a308d39db357fb extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<header>
    <div class=\"header\">
        <h1>Логотип</h1>
        <nav>
            <ul>
                <li><a href=\"/\">Главная</a></li>
                <li><a href=\"/about\">О нас</a></li>
                <li><a href=\"/contact\">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>
";
    }

    public function getTemplateName()
    {
        return "header.tpl";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.tpl", "/data/mysite.local/src/Views/header.tpl");
    }
}
