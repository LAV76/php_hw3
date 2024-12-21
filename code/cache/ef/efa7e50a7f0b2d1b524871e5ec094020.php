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

/* main.tpl */
class __TwigTemplate_247c9c4e490c3bc96f40c9d312814378 extends Template
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
        echo "<!DOCTYPE html>
<html>
<link rel=\"stylesheet\" href=\"styles.css\">

<head>
    <title>";
        // line 6
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
</head>
<body>
    ";
        // line 9
        $this->loadTemplate("header.tpl", "main.tpl", 9)->display($context);
        // line 10
        echo "    <div class=\"main-content\">
    <p>Текущее время: ";
        // line 11
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "H:i:s"), "html", null, true);
        echo "</p>
        <div class=\"content\">
            ";
        // line 13
        $this->loadTemplate(($context["content_template_name"] ?? null), "main.tpl", 13)->display($context);
        // line 14
        echo "        </div>
        <div class=\"sidebar\">
            ";
        // line 16
        $this->loadTemplate("sidebar.tpl", "main.tpl", 16)->display($context);
        // line 17
        echo "        </div>
    </div>
    ";
        // line 19
        $this->loadTemplate("footer.tpl", "main.tpl", 19)->display($context);
        // line 20
        echo "</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "main.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 20,  72 => 19,  68 => 17,  66 => 16,  62 => 14,  60 => 13,  55 => 11,  52 => 10,  50 => 9,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.tpl", "/data/mysite.local/src/Views/main.tpl");
    }
}
