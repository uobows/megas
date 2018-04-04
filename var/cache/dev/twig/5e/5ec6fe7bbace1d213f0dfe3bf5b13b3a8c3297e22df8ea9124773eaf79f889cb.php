<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_75da8efc6339abeb7ca782d43452345bb4de5c2bdc58b9d9b17717a2a0f77ec3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_dc0f9441f366ceb1a6c042dcb16c9faf6c7d7706e23c50079ba6c3254d86154d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_dc0f9441f366ceb1a6c042dcb16c9faf6c7d7706e23c50079ba6c3254d86154d->enter($__internal_dc0f9441f366ceb1a6c042dcb16c9faf6c7d7706e23c50079ba6c3254d86154d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_dc0f9441f366ceb1a6c042dcb16c9faf6c7d7706e23c50079ba6c3254d86154d->leave($__internal_dc0f9441f366ceb1a6c042dcb16c9faf6c7d7706e23c50079ba6c3254d86154d_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_77f4d1c336bd42f95f00b55b32048133efe518e8c739331b73a2ed54c3811394 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_77f4d1c336bd42f95f00b55b32048133efe518e8c739331b73a2ed54c3811394->enter($__internal_77f4d1c336bd42f95f00b55b32048133efe518e8c739331b73a2ed54c3811394_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_77f4d1c336bd42f95f00b55b32048133efe518e8c739331b73a2ed54c3811394->leave($__internal_77f4d1c336bd42f95f00b55b32048133efe518e8c739331b73a2ed54c3811394_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_26e629440181322763ca59c80d54cf65c8dd2766b77062b39ed85d7a72c21364 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_26e629440181322763ca59c80d54cf65c8dd2766b77062b39ed85d7a72c21364->enter($__internal_26e629440181322763ca59c80d54cf65c8dd2766b77062b39ed85d7a72c21364_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_26e629440181322763ca59c80d54cf65c8dd2766b77062b39ed85d7a72c21364->leave($__internal_26e629440181322763ca59c80d54cf65c8dd2766b77062b39ed85d7a72c21364_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_bc046307616c18ed4657f184dab3d0e0daf1f79a03ce5720bc612e06310ca172 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_bc046307616c18ed4657f184dab3d0e0daf1f79a03ce5720bc612e06310ca172->enter($__internal_bc046307616c18ed4657f184dab3d0e0daf1f79a03ce5720bc612e06310ca172_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_bc046307616c18ed4657f184dab3d0e0daf1f79a03ce5720bc612e06310ca172->leave($__internal_bc046307616c18ed4657f184dab3d0e0daf1f79a03ce5720bc612e06310ca172_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
";
    }
}
