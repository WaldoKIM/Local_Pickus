<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* database/tracking/untracked_tables.twig */
class __TwigTemplate_e198065778040803bedd6f19403b4e82d8e8e0c5fba23d78f3227f1818ca3e2a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<h3>";
        echo _gettext("Untracked tables");
        echo "</h3>
<form method=\"post\" action=\"db_tracking.php\" name=\"untrackedForm\"
    id=\"untrackedForm\" class=\"ajax\">
    ";
        // line 4
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
    <table id=\"noversions\" class=\"data\">
        <thead>
            <tr>
                <th></th>
                <th>";
        // line 9
        echo _gettext("Table");
        echo "</th>
                <th>";
        // line 10
        echo _gettext("Action");
        echo "</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["untracked_tables"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["table_name"]) {
            // line 15
            echo "                ";
            if ((PhpMyAdmin\Tracker::getVersion(($context["db"] ?? null), $context["table_name"]) ==  -1)) {
                // line 16
                echo "                    <tr>
                        <td class=\"center\">
                            <input type=\"checkbox\" name=\"selected_tbl[]\"
                                class=\"checkall\" id=\"selected_tbl_";
                // line 19
                echo twig_escape_filter($this->env, $context["table_name"], "html", null, true);
                echo "\"
                                value=\"";
                // line 20
                echo twig_escape_filter($this->env, $context["table_name"], "html", null, true);
                echo "\"/>
                        </td>
                        <th>
                            <label for=\"selected_tbl_";
                // line 23
                echo twig_escape_filter($this->env, $context["table_name"], "html", null, true);
                echo "\">
                                ";
                // line 24
                echo twig_escape_filter($this->env, $context["table_name"], "html", null, true);
                echo "
                            </label>
                        </th>
                        <td>
                            <a href=\"tbl_tracking.php";
                // line 28
                echo ($context["url_query"] ?? null);
                echo "&amp;table=";
                echo twig_escape_filter($this->env, $context["table_name"], "html", null, true);
                echo "\">
                                ";
                // line 29
                echo PhpMyAdmin\Util::getIcon("eye", _gettext("Track table"));
                echo "
                            </a>
                        </td>
                    </tr>
                ";
            }
            // line 34
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['table_name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "        </tbody>
    </table>
    ";
        // line 37
        $this->loadTemplate("select_all.twig", "database/tracking/untracked_tables.twig", 37)->display(twig_to_array(["pma_theme_image" =>         // line 38
($context["pma_theme_image"] ?? null), "text_dir" =>         // line 39
($context["text_dir"] ?? null), "form_name" => "untrackedForm"]));
        // line 42
        echo "    ";
        echo PhpMyAdmin\Util::getButtonOrImage("submit_mult", "mult_submit", _gettext("Track table"), "eye", "track");
        // line 48
        echo "
</form>
";
    }

    public function getTemplateName()
    {
        return "database/tracking/untracked_tables.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 48,  117 => 42,  115 => 39,  114 => 38,  113 => 37,  109 => 35,  103 => 34,  95 => 29,  89 => 28,  82 => 24,  78 => 23,  72 => 20,  68 => 19,  63 => 16,  60 => 15,  56 => 14,  49 => 10,  45 => 9,  37 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "database/tracking/untracked_tables.twig", "/var/www/html/myadmin/templates/database/tracking/untracked_tables.twig");
    }
}
