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

/* table/tracking/create_version.twig */
class __TwigTemplate_2168817728307e62f7ae5c2724fc59f473faf6829bf4d5660485e890e191ac32 extends \Twig\Template
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
        echo "<div id=\"div_create_version\">
    <form method=\"post\" action=\"";
        // line 2
        echo ($context["url_query"] ?? null);
        echo "\">
        ";
        // line 3
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
        ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["selected"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["selected_table"]) {
            // line 5
            echo "            <input type=\"hidden\" name=\"selected[]\" value=\"";
            echo twig_escape_filter($this->env, $context["selected_table"], "html", null, true);
            echo "\">
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['selected_table'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "
        <fieldset>
            <legend>
                ";
        // line 10
        if ((twig_length_filter($this->env, ($context["selected"] ?? null)) == 1)) {
            // line 11
            echo "                    ";
            echo twig_escape_filter($this->env, sprintf(_gettext("Create version %1\$s of %2\$s"), (            // line 12
($context["last_version"] ?? null) + 1), ((            // line 13
($context["db"] ?? null) . ".") . $this->getAttribute(($context["selected"] ?? null), 0, [], "array"))), "html", null, true);
            // line 14
            echo "
                ";
        } else {
            // line 16
            echo "                    ";
            echo twig_escape_filter($this->env, sprintf(_gettext("Create version %1\$s"), (($context["last_version"] ?? null) + 1)), "html", null, true);
            echo "
                ";
        }
        // line 18
        echo "            </legend>
            <input type=\"hidden\" name=\"version\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, (($context["last_version"] ?? null) + 1), "html", null, true);
        echo "\">
            <p>";
        // line 20
        echo _gettext("Track these data definition statements:");
        echo "</p>

            ";
        // line 22
        if (((($context["type"] ?? null) == "both") || (($context["type"] ?? null) == "table"))) {
            // line 23
            echo "                <input type=\"checkbox\" name=\"alter_table\" value=\"true\"";
            // line 24
            echo ((twig_in_filter("ALTER TABLE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                ALTER TABLE<br/>
                <input type=\"checkbox\" name=\"rename_table\" value=\"true\"";
            // line 27
            echo ((twig_in_filter("RENAME TABLE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                RENAME TABLE<br/>
                <input type=\"checkbox\" name=\"create_table\" value=\"true\"";
            // line 30
            echo ((twig_in_filter("CREATE TABLE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                CREATE TABLE<br/>
                <input type=\"checkbox\" name=\"drop_table\" value=\"true\"";
            // line 33
            echo ((twig_in_filter("DROP TABLE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                DROP TABLE<br/>
            ";
        }
        // line 36
        echo "            ";
        if ((($context["type"] ?? null) == "both")) {
            // line 37
            echo "                <br/>
            ";
        }
        // line 39
        echo "            ";
        if (((($context["type"] ?? null) == "both") || (($context["type"] ?? null) == "view"))) {
            // line 40
            echo "                <input type=\"checkbox\" name=\"alter_view\" value=\"true\"";
            // line 41
            echo ((twig_in_filter("ALTER VIEW", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                ALTER VIEW<br/>
                <input type=\"checkbox\" name=\"create_view\" value=\"true\"";
            // line 44
            echo ((twig_in_filter("CREATE VIEW", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                CREATE VIEW<br/>
                <input type=\"checkbox\" name=\"drop_view\" value=\"true\"";
            // line 47
            echo ((twig_in_filter("DROP VIEW", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
            echo ">
                DROP VIEW<br/>
            ";
        }
        // line 50
        echo "            <br/>

            <input type=\"checkbox\" name=\"create_index\" value=\"true\"";
        // line 53
        echo ((twig_in_filter("CREATE INDEX", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            CREATE INDEX<br/>
            <input type=\"checkbox\" name=\"drop_index\" value=\"true\"";
        // line 56
        echo ((twig_in_filter("DROP INDEX", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            DROP INDEX<br/>

            <p>";
        // line 59
        echo _gettext("Track these data manipulation statements:");
        echo "</p>
            <input type=\"checkbox\" name=\"insert\" value=\"true\"";
        // line 61
        echo ((twig_in_filter("INSERT", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            INSERT<br/>
            <input type=\"checkbox\" name=\"update\" value=\"true\"";
        // line 64
        echo ((twig_in_filter("UPDATE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            UPDATE<br/>
            <input type=\"checkbox\" name=\"delete\" value=\"true\"";
        // line 67
        echo ((twig_in_filter("DELETE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            DELETE<br/>
            <input type=\"checkbox\" name=\"truncate\" value=\"true\"";
        // line 70
        echo ((twig_in_filter("TRUNCATE", ($context["default_statements"] ?? null))) ? (" checked=\"checked\"") : (""));
        echo ">
            TRUNCATE<br/>
        </fieldset>

        <fieldset class=\"tblFooters\">
            <input type=\"hidden\" name=\"submit_create_version\" value=\"1\" />
            <input type=\"submit\" value=\"";
        // line 76
        echo _gettext("Create version");
        echo "\" />
        </fieldset>
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "table/tracking/create_version.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  184 => 76,  175 => 70,  170 => 67,  165 => 64,  160 => 61,  156 => 59,  150 => 56,  145 => 53,  141 => 50,  135 => 47,  130 => 44,  125 => 41,  123 => 40,  120 => 39,  116 => 37,  113 => 36,  107 => 33,  102 => 30,  97 => 27,  92 => 24,  90 => 23,  88 => 22,  83 => 20,  79 => 19,  76 => 18,  70 => 16,  66 => 14,  64 => 13,  63 => 12,  61 => 11,  59 => 10,  54 => 7,  45 => 5,  41 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/tracking/create_version.twig", "/var/www/html/myadmin/templates/table/tracking/create_version.twig");
    }
}
