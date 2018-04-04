<?php

/* base.html.twig */
class __TwigTemplate_43bf949175d3bec6e04a38da2b842e4b3dfddbc8d9c5c7a4f6bbb5935a940fdf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a9cf710bfc2d4e48afa0552f60933e7d26cb8d162f815900fffca6cd1cdf96f0 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a9cf710bfc2d4e48afa0552f60933e7d26cb8d162f815900fffca6cd1cdf96f0->enter($__internal_a9cf710bfc2d4e48afa0552f60933e7d26cb8d162f815900fffca6cd1cdf96f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_a9cf710bfc2d4e48afa0552f60933e7d26cb8d162f815900fffca6cd1cdf96f0->leave($__internal_a9cf710bfc2d4e48afa0552f60933e7d26cb8d162f815900fffca6cd1cdf96f0_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_6ac959d64df87e6e0740f707225d5ab68bd2cf73ff4761ba7844bd099c6194cf = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6ac959d64df87e6e0740f707225d5ab68bd2cf73ff4761ba7844bd099c6194cf->enter($__internal_6ac959d64df87e6e0740f707225d5ab68bd2cf73ff4761ba7844bd099c6194cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_6ac959d64df87e6e0740f707225d5ab68bd2cf73ff4761ba7844bd099c6194cf->leave($__internal_6ac959d64df87e6e0740f707225d5ab68bd2cf73ff4761ba7844bd099c6194cf_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_4cedbf42bf93076a6eae7732d9bd55af85c74f33bc8b4e20f45c646f62a330ea = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4cedbf42bf93076a6eae7732d9bd55af85c74f33bc8b4e20f45c646f62a330ea->enter($__internal_4cedbf42bf93076a6eae7732d9bd55af85c74f33bc8b4e20f45c646f62a330ea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_4cedbf42bf93076a6eae7732d9bd55af85c74f33bc8b4e20f45c646f62a330ea->leave($__internal_4cedbf42bf93076a6eae7732d9bd55af85c74f33bc8b4e20f45c646f62a330ea_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_aa833e3e00a5d8d96773da165a9161802a84d968199d06e55e269feb073e21c2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_aa833e3e00a5d8d96773da165a9161802a84d968199d06e55e269feb073e21c2->enter($__internal_aa833e3e00a5d8d96773da165a9161802a84d968199d06e55e269feb073e21c2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_aa833e3e00a5d8d96773da165a9161802a84d968199d06e55e269feb073e21c2->leave($__internal_aa833e3e00a5d8d96773da165a9161802a84d968199d06e55e269feb073e21c2_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_531320bc09b1d38067cedf6dbb5b19c6e796c51661e61d45c9212dd432a7fa56 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_531320bc09b1d38067cedf6dbb5b19c6e796c51661e61d45c9212dd432a7fa56->enter($__internal_531320bc09b1d38067cedf6dbb5b19c6e796c51661e61d45c9212dd432a7fa56_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_531320bc09b1d38067cedf6dbb5b19c6e796c51661e61d45c9212dd432a7fa56->leave($__internal_531320bc09b1d38067cedf6dbb5b19c6e796c51661e61d45c9212dd432a7fa56_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }

    public function getSource()
    {
        return "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
";
    }
}
