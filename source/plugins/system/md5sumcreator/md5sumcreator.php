<?php
// @todo: Test if this actually works or not

class PlgSystemMd5sumcreator extends JPlugin
{
    protected $paths = array();

    public function onAfterDispatch()
    {
        $this->collectPaths();

        if (!empty($paths))
        {
            foreach($paths as $path)
            {
                $this->createHashForFolder($path);
            }
        }
    }

    protected function createHashForFolder($folder)
    {
        $hashes = array();
        $cssFiles = glob($folder.'/*.css');
        $jsFiles = glob($folder.'/*.js');

        if (!empty($cssFiles))
        {
            foreach ($cssFiles as $cssFile) 
            {
                $hashes[] = md5_file($cssFile);
            }
        }

        if (!empty($jsFiles))
        {
            foreach ($jsFiles as $jsFile) 
            {
                $hashes[] = md5_file($jsFile);
            }
        }

        $newHash = md5(implode('', $hashes));
        $existingHash = null;

        if (file_exists($folder.'/MD5SUM'))
        {
            $existingHash = file_get_contents($folder.'/MD5SUM');
        }

        if ($newHash != $existingHash)
        {
            file_put_contents($folder.'/MD5SUM', $newHash);
        }
    }

    protected function collectPaths()
    {
        $template = JFactory::getApplication()->getTemplate();

        if (is_dir(JPATH_THEMES.'/'.$template.'/css'))
        {
            $this->paths[] = JPATH_THEMES.'/'.$template.'/css';
        }
        
        if (is_dir(JPATH_THEMES.'/'.$template.'/js'))
        {
            $this->paths[] = JPATH_THEMES.'/'.$template.'/js';
        }
    }
}
