<?php

namespace Chsv\MyTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MyTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the index method action,
     * @return string
     */
    public function indexAction() : object
    {
        $title = "Testing textfilter | index";
        $text = file_get_contents(__DIR__ . "/text/exampletext.txt");
        $filtername[] = "no filter selected";

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $text,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * bbcode-test
     *
     * @return object
     */
    public function bbcodeActionGet() : object
    {
        $title = "Testing textfilter | bbcode";
        $text = file_get_contents(__DIR__ . "/text/bbcode.txt");
        $filtername[] = "bbcode";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * clickable-test
     *
     * @return object
     */
    public function clickableActionGet() : object
    {
        $title = "Testing textfilter | clickable";
        $text = file_get_contents(__DIR__ . "/text/clickable.txt");
        $filtername[] = "link";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);


        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * markdown-test
     *
     * @return object
     */
    public function markdownActionGet() : object
    {
        $title = "Testing textfilter | markdown";
        $text = file_get_contents(__DIR__ . "/text/sample.md");
        $filtername[] = "markdown";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * nl2br-test
     *
     * @return object
     */
    public function nl2brActionGet() : object
    {
        $title = "Testing textfilter | nl2br";
        $text = file_get_contents(__DIR__ . "/text/exampletext.txt");
        $filtername[] = "nl2br";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * strip-test
     *
     * @return object
     */
    public function stripActionGet() : object
    {
        $title = "Testing textfilter | strip";
        $text = file_get_contents(__DIR__ . "/text/exampletext.txt");
        $filtername[] = "strip";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * esc-test
     *
     * @return object
     */
    public function escActionGet() : object
    {
        $title = "Testing textfilter | esc";
        $text = file_get_contents(__DIR__ . "/text/exampletext.txt");
        $filtername[] = "esc";
        $filter = New MyTextFilter;
        $textedited = $filter->parse($text, $filtername);

        $this->app->page->add("textfilter/index", [
            "origin" => $text,
            "resultset" => $textedited,
            "filter" => $filtername[0],
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
