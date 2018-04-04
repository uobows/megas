<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_c7f76937d2988e21212f36f45d5b751453380f505c28c29470d05a6f8c34a096 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b92f938a50464a521c741837d64af696d0e282003c3d7534beef69e58f6a4fe5 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_b92f938a50464a521c741837d64af696d0e282003c3d7534beef69e58f6a4fe5->enter($__internal_b92f938a50464a521c741837d64af696d0e282003c3d7534beef69e58f6a4fe5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b92f938a50464a521c741837d64af696d0e282003c3d7534beef69e58f6a4fe5->leave($__internal_b92f938a50464a521c741837d64af696d0e282003c3d7534beef69e58f6a4fe5_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_f6e827098fae48d3a8dcfe93ceaca7e9a0385ca65823907de28039c96475fcbf = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f6e827098fae48d3a8dcfe93ceaca7e9a0385ca65823907de28039c96475fcbf->enter($__internal_f6e827098fae48d3a8dcfe93ceaca7e9a0385ca65823907de28039c96475fcbf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpFoundationExtension')->generateAbsoluteUrl($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_f6e827098fae48d3a8dcfe93ceaca7e9a0385ca65823907de28039c96475fcbf->leave($__internal_f6e827098fae48d3a8dcfe93ceaca7e9a0385ca65823907de28039c96475fcbf_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_eec9bb488bcc5028862ed4e888d25dc398a5cbc7d7f4bd337b41de8682a8df2b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_eec9bb488bcc5028862ed4e888d25dc398a5cbc7d7f4bd337b41de8682a8df2b->enter($__internal_eec9bb488bcc5028862ed4e888d25dc398a5cbc7d7f4bd337b41de8682a8df2b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_eec9bb488bcc5028862ed4e888d25dc398a5cbc7d7f4bd337b41de8682a8df2b->leave($__internal_eec9bb488bcc5028862ed4e888d25dc398a5cbc7d7f4bd337b41de8682a8df2b_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_ee31a44381493a2ecb0d57927e2dfc2972e39f7bdaffd9fd63cce11ce50ecd0f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ee31a44381493a2ecb0d57927e2dfc2972e39f7bdaffd9fd63cce11ce50ecd0f->enter($__internal_ee31a44381493a2ecb0d57927e2dfc2972e39f7bdaffd9fd63cce11ce50ecd0f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_ee31a44381493a2ecb0d57927e2dfc2972e39f7bdaffd9fd63cce11ce50ecd0f->leave($__internal_ee31a44381493a2ecb0d57927e2dfc2972e39f7bdaffd9fd63cce11ce50ecd0f_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <link href=\"{{ absolute_url(asset('bundles/framework/css/exception.css')) }}\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
";
    }
}
