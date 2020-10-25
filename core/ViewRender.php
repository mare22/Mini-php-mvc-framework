<?php

namespace Core;

class ViewRender
{
    public $viewContent;

    public $fullViewPage;

    public $viewPath;

    public $viewLayout = [];

    public $viewSections = [];

    public function __construct(string $viewPath)
    {
        $this->viewContent = $this->getViewContent(
            $this->viewPath = $this->parseViewPath($viewPath)
        );
    }

    public function render()
    {
        $this->viewLayout = $this->getLayoutFromViewContent();

        if($this->viewLayout) {
            $this->viewSections = $this->getSectionsFromViewContent();
            $this->fullViewPage = $this->mergeSectionsAndLayout();
        } else {
            $this->fullViewPage = $this->viewContent;
        }

        $this->replaceIncludeDirective();

        /** TODO Replace
         * @if, @elseif, @else, @endif
         * @for, @endfor, @foreach, @endforeach
         * @while, @endwhile,
         * @swich, @case, @default
         */

        return $this->fullViewPage;
    }

    private function replaceIncludeDirective()
    {
        preg_match_all("/@include\([\"|'](.*?)[\"|']\)/", $this->fullViewPage, $includes);

        foreach ($includes[1] as $include) {
            $includePath = $this->parseViewPath($include);
            $this->fullViewPage = preg_replace(
                "/@include\([\"|']{$include}[\"|']\)/",
                "<?php require('{$includePath}') ?>",
                $this->fullViewPage
            );
        }
    }

    private function mergeSectionsAndLayout()
    {
        foreach ($this->viewSections as $section => $content) {
            $this->viewLayout = preg_replace("/@yield\([\"|\']({$section})[\"|\']\)/", $content, $this->viewLayout);
        }

        return $this->viewLayout;
    }

    private function getLayoutFromViewContent()
    {
        $extendPattern = "/@extends\([\"|\'](.*?)[\"|\']\)/";

        // Find layout in view file.
        preg_match($extendPattern, $this->viewContent, $extend);

        //Return null if layout doesn't exist
        if(!$extend) return null;

        //Return layout content
        return file_get_contents( $this->parseViewPath($extend[1]) );
    }

    private function getSectionsFromViewContent()
    {
        $sectionPattern = "/@section\([\"|\'](.*?)[\"|\']\)/";

        preg_match_all($sectionPattern, $this->viewContent, $sections);

        $viewSections = [];
        foreach ($sections[1] as $section) {
            preg_match("/@section\([\"|\']{$section}[\"|\']\)(.*?)@endsection/ms", $this->viewContent, $sectionContent);

            $viewSections[$section] = $sectionContent[1];
        }

        return $viewSections;
    }

    private function getViewContent($viewPath)
    {
        return file_get_contents($viewPath);
    }

    private function parseViewPath($path)
    {
        $path = str_replace('.', '/', $path);
        $fullPath = root_path() . "/resources/views/$path.view.php";

        if(!file_exists($fullPath)) {
            throw new \Exception("File {$fullPath} does not exist");
        }

        return $fullPath;
    }
}