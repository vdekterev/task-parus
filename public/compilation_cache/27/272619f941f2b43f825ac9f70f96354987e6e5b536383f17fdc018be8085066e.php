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
class __TwigTemplate_066e475f1e6caa0f569307fdad8b24eb076a2992b40f57951e0c68afa58c0a2d extends Template
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
        echo "    <div class=\"container text-center mt-4\">
        <div class=\"row justify-content-md-center\">%}
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
                ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            // line 20
            echo "                <tr>
                    <th scope=\"row\">
                        ";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["d"], "id", [], "any", false, false, false, 22), "html", null, true);
            echo "
                    </th>
                    <td><?= substr(\$d->content, 0, 10) ?>...</td>
                    <td><?= \$d->initial_price ?></td>
                    <td><?= \$d->email ?></td>
                    <td><?= \$d->phone ?></td>
                    <td><?= \$d->debtor_inn ?></td>
                    <td><?= \$d->case_number ?></td>
                    <td><?= \$d->start_date ?></td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "                </tbody>
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
        return array (  93 => 33,  76 => 22,  72 => 20,  68 => 19,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/var/www/parserui/app/views/trades/templates/index.twig");
    }
}
