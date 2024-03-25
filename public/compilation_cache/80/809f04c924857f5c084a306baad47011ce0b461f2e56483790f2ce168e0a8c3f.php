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

/* index.twig */
class __TwigTemplate_5a02e6e048ad413f5fabcfb65edaa81cb89d9fe9258b3bd5a2cc3e870bbfcb29 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.twig", "index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo " <div class=\"container text-center mt-4\">
        <div class=\"row justify-content-md-center\">
            <table class=\"table\">
                <thead>
                <tr>
                    <th scope=\"col\">Fedid</th>
                    <th scope=\"col\">Описание</th>
                    <th scope=\"col\">Начальная цена</th>
                    <th scope=\"col\">Email контактного лица</th>
                    <th scope=\"col\">Номер контактного лица</th>
                    <th scope=\"col\">ИНН должника</th>
                    <th scope=\"col\">Номер дела</th>
                    <th scope=\"col\">Дата проведения</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <th scope=\"row\">

                    </th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "index.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/var/www/parserui/app/views/trades/index.twig");
    }
}
