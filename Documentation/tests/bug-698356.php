<?php 
/**
 * This is a test of bug 698356.  Must be parsed with -pp on to test
 *
 * {@internal internaltest with a {@link echo()}.}} should
 * not throw error.
 * @package tests
 */
    /**
     * Create the phpdoc.hhp, contents.hhc files needed by MS HTML Help Compiler
     * to create a CHM file
     *
     * The output function generates the table of contents (contents.hhc)
     * and file list (phpdoc.hhp) files used to create a .CHM by the
     * free MS HTML Help compiler.
     * {@internal
     * Using {@link $hhp_files}, a list of all separate .html files
     * is created in CHM format, and written to phpdoc.hhp.  This list was
     * generated by {@link writefile}.
     *
     * Next, a call to the table of contents:
     * finishes things off}}
     * @link http://www.microsoft.com/downloads/release.asp?releaseid=33071
     * @uses generateTOC() assigns to the toc template variable
     */
    function bug698356_Output()
    {
        $templ = &$this->newSmarty();
        $file = $this->base_dir . PATH_DELIMITER;
        $file = str_replace('\\',PATH_DELIMITER,$file);
        $file = str_replace('//',PATH_DELIMITER,$file);
        $file = str_replace(PATH_DELIMITER,'\\',$file);
        $templ->assign('files',$this->hhp_files);
        $this->setTargetDir($this->base_dir);
        Converter::writefile('phpdoc.hhp',$templ->fetch('hhp.tpl'));
        $templ = &$this->newSmarty();
        $templ->assign('toc',$this->generateTOC());
        Converter::writefile('contents.hhc',$templ->fetch('contents.hhc.tpl'));
        phpDocumentor_out("NOTE: to create the documentation.chm file, you must now run Microsoft Help Workshop on phpdoc.hhp\n");
        phpDocumentor_out("To get the free Microsoft Help Workshop, browse to: http://www.microsoft.com/downloads/release.asp?releaseid=33071\n");
        flush();
    }

?>