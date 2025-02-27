<?php

declare(strict_types=1);

class PixelFileHandlerTheme extends Themelet
{
    public function display_image(Page $page, Image $image)
    {
        global $config;

        $u_ilink = $image->get_image_link();
        if ($config->get_bool(ImageConfig::SHOW_META) && function_exists(ImageIO::EXIF_READ_FUNCTION)) {
            # FIXME: only read from jpegs?
            $exif = @exif_read_data($image->get_image_filename(), "IFD0", true);
            if ($exif) {
                $head = "";
                foreach ($exif as $key => $section) {
                    foreach ($section as $name => $val) {
                        if ($key == "IFD0") {
                            // Cheap fix for array'd values in EXIF-data
                            if (is_array($val)) {
                                $val = implode(',', $val);
                            }
                            $head .= html_escape("$name: $val")."<br>\n";
                        }
                    }
                }
                if ($head) {
                    $page->add_block(new Block("EXIF Info", $head, "left"));
                }
            }
        }

        $html = "<img alt='main image' class='shm-main-image' id='main_image' src='$u_ilink' ".
            "data-width='{$image->width}' data-height='{$image->height}' data-mime='{$image->get_mime()}'>";
        $page->add_block(new Block("Image", $html, "main", 10));
    }
}
