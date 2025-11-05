// Ensure you have all necessary imports
import "./bootstrap";

import grapesjs from "grapesjs";
import "grapesjs/dist/css/grapes.min.css";
import grapesjsPresetWebpage from "grapesjs-preset-webpage";
import grapesjsBlocksBasic from "grapesjs-blocks-basic";

document.addEventListener("DOMContentLoaded", () => {
    // CRITICAL: Initialize GrapesJS and assign it to the window object
    window.editor = grapesjs.init({
        container: "#gjs",
        height: "100%", // Use 100% since we set 800px on the #gjs container
        width: "auto",
        fromElement: true,
        storageManager: false,
        plugins: [grapesjsPresetWebpage, grapesjsBlocksBasic],
        pluginsOpts: {
            [grapesjsPresetWebpage]: {},
            [grapesjsBlocksBasic]: {
                flexGrid: true,
                blocks: [
                    "column1",
                    "column2",
                    "column3",
                    "column3-7",
                    "text",
                    "link",
                    "image",
                    "video",
                    "map",
                    "link-block",
                    "quote",
                    "text-section",
                ],
            },
        },
    });
});
