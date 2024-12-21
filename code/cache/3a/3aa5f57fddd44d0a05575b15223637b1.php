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

/* error.tpl */
class __TwigTemplate_79384037e8d3de900a0706015e2190e4 extends Template
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
<head>
    <title>Ошибка</title>
    <link rel=\"stylesheet\" href=\"styles.css\">
</head>
<body>
    <h1>Что-то пошло не так</h1>
    <p>";
        // line 9
        echo twig_escape_filter($this->env, ($context["error_message"] ?? null), "html", null, true);
        echo "</p>
    <p><a href=\"/\">Вернуться на главную</a></p>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "error.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "error.tpl", "/data/mysite.local/src/Views/error.tpl");
    }
}
