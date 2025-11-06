import grapesjs from "grapesjs";
import "grapesjs/dist/css/grapes.min.css";
import grapesjsPresetWebpage from "grapesjs-preset-webpage";
import grapesjsBlocksBasic from "grapesjs-blocks-basic";

document.addEventListener("DOMContentLoaded", () => {
    // Expose editor on window so blade scripts can read its data before form submit
    window.editor = grapesjs.init({
        container: "#gjs",
        height: "100vh",
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
