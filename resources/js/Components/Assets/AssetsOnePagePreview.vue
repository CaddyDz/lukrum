<template>
    <div>
        <div class="w-max mt-5">
            <a class="the-button inline-flex items-center px-6 py-2 border border-transparent text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 edit-button" style="cursor:pointer;"  @click="downloadWithCSS">Download PDF</a>
        </div>
    </div>
    <div ref="content" class="mt-6 mb-6 flex justify-center">
        <div class="preview flex" v-if="layout" :style="{height: height + 'px', width: width + 'px', }">
            <div class="preview-outer" :style="previewOuterCss">
                <div class="preview-inner" :class="layout.code">
                    <!--                                :style="{backgroundImage: assetColor ? 'linear-gradient(white, ' + assetColor.css + ')' : 'grey'}"-->
                    <div class="logo-area" :style="logoAreaCss">
                        <!--                                    <div class="logo-container">-->
                        <img :src="logo" alt="Partner Logo" v-if="logo" />
                        <!--                                    </div>-->
                    </div>

                    <div class="headline" ref="headlineDiv" :style="headlineCss" v-html="headlinePrepared"></div>
                    <div class="intro" ref="introDiv" style="width: 389px;" :style="introCss" v-html="intro"></div>
                    <div class="body-text" :style="bodyTextCss" v-html="bodyText"></div>
                    <div class="cta" :style="ctaCss" v-text="cta"></div>
                    <div class="professionals" :style="professionalsCss" v-text="professionals"></div>
                    <div class="projects" :style="projectsCss" v-text="projects"></div>

                    <div class="image-overlay" v-if="!!layout.overlay" :style="overlayCss">
                        <div class="image-overlay-layer2" v-if="!!layout.overlay.layer2" :style="layer2Css"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <svg style="display:none;">
            <filter id="logo_filter" type="matrix" color-interpolation-filters="sRGB">
                <feColorMatrix type="matrix"
               values="0 0 0 0 1
                       0 0 0 0 1
                       0 0 0 0 1
                       0 0 0 1 0" />
            </filter>
        </svg>
    </div>
</template>

<script>

import {Cloudinary} from "@cloudinary/base";
import {replaceColor} from "@cloudinary/base/actions/adjust";
import jsPDF from 'jspdf';
import domtoimage from "dom-to-image";
// Create a Cloudinary instance and set your cloud name.
const cld = new Cloudinary({
    cloud: {
        cloudName: 'pierry'
    }
});

// cld.image returns a CloudinaryImage with the configuration set.

// This returns: https://res.cloudinary.com/demo/image/upload/sample

export default {
    name: "AssetsOnePagePreview",
    props: ["layout", "logo", "overlay", "color", "headline", "intro", "bodyText", "cta", "width", "height", "professionals", "projects",],

    data() {
        return {
            headlineFlag: false,
        }
    },

    mounted() {
        this.$nextTick(() => {
            this.headlineFlag = !this.headlineFlag;
        });
    },

    computed: {
        bgImage() {
            let myImage = cld.image(this.layout.empty_public_id);

            if(this.layout.color_changeable && this.color !== this.layout.base_color && /^#[0-9a-f]{6}$/i.test(this.color)) {
                myImage.adjust(replaceColor(this.color).fromColor(this.layout.base_color).tolerance(50));
            }
            return myImage.toURL();
        },

        overlayUrl() {

            if(!this.layout.has_overlay) return "";
            if("default" === this.overlay) return this.layout.overlay.url;
            return this.overlay;
        },


        layer2Url() {
            if(!this.layout.has_overlay) return "";
            if(!this.layout.overlay.layer2) return "";

            let myImage = cld.image(this.layout.overlay.layer2.public_id.replace(/:/g, '/'));
            if(this.layout.color_changeable && this.color !== this.layout.base_color && /^#[0-9a-f]{6}$/i.test(this.color)) {
                myImage.adjust(replaceColor(this.color).fromColor(this.layout.base_color).tolerance(50));
            }
            return myImage.toURL();
        },

        headlinePrepared() {
            if("string" === typeof this.headline) {
                return this.headline;
            }
            if(null === this.headline) {
                return "";
            }

            const layout = this.layout;

            let assetColor = layout.base_color;
            if(/^#[0-9a-f]{6}$/i.test(this.color))  {
                assetColor = this.color;
            }

            let primaryColor = layout.headline.c;
            if("asset" === primaryColor) primaryColor = assetColor;

            let secondaryColor = layout.headline.sc;
            if("asset" === secondaryColor) secondaryColor = assetColor;

            const x = this.headline.parts.map(x => {
                return '<span style="color:'+(x.color === "primary" ? primaryColor : secondaryColor)+'">'+x.body+'</span>';
            });
            return x.join('');
        },

        previewSize() {
            const parentWidth = this.width;
            const parentHeight = this.height;
            const parentAspectRatio = parentHeight / parentHeight;

            const layout = this.layout;
            const aspectRatio = layout.size.w / layout.size.h;

            let h, w;
            if(aspectRatio >= parentAspectRatio) {
                w = parentWidth;
                h = parentWidth / aspectRatio;
            } else {
                h = parentHeight;
                w = parentHeight * aspectRatio;
            }

            return {h, w};
        },

        previewMultipliers() {
            const layout = this.layout;

            return {x: this.previewSize.w / layout.size.w, y: this.previewSize.h / layout.size.h};
        },

        headlineClientHeight() {
            const dummy = this.headlineFlag;

            if(this.$refs.headlineDiv) {
                return this.$refs.headlineDiv.clientHeight;
            }
            return 0;
        },

        previewOuterCss() {
            return {
                backgroundImage: 'url(' + this.bgImage + ')',
                height: this.previewSize.h + 'px',
                width: this.previewSize.w + 'px',
            };

        },

        logoAreaCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;
            return {
                left: (layout.logo.x * m.x) + 'px',
                top: (layout.logo.y * m.y) + 'px',

                width: (layout.logo.w * m.x) + 'px',
                height: (layout.logo.h * m.y) + 'px',
            };

        },

        ctaCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            let fontSize = 1.2;
            fontSize *= m.x;

            if(layout.cta.s) {
                fontSize *= layout.cta.s;
            }
            if(this.cta.length >= 24) {
                fontSize *= 0.5;
            } else if(this.cta.length >= 30) {
                fontSize *= 0.6;
            } else if(this.cta.length >= 40) {
                fontSize *= 0.7;
            }

            let assetColor = layout.base_color;
            if(/^#[0-9a-f]{6}$/i.test(this.color))  {
                assetColor = this.color;
            }
            let ctaColor = layout.cta.c;
            if("asset" === ctaColor) ctaColor = assetColor;

            let fontFamily = "inherited";
            if(layout.cta.ff) {
                switch(layout.cta.ff) {
                    case "times":
                        fontFamily = "times";
                        break;

                    case "sans-serif":
                        fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                        break;
                }
            }

            return {
                left: (layout.cta.l * m.x) + "px",
                right: (layout.cta.r * m.x) + "px",
                top: (layout.cta.y * m.y) + "px",
                height: (layout.cta.h * m.y) + "px",
                color: ctaColor,
                // textTransform: "uppercase",
                // fontWeight: "bold",
                fontSize: fontSize+"em",
                lineHeight: "1em",
                fontFamily,
            }

        },

        professionalsCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            if(!layout.professionals) {
                return {
                    display: "none",
                }
            }

            let fontSize = 2;
            fontSize *= m.x;

            if(layout.professionals.s) {
                fontSize *= layout.professionals.s;
            }

            let assetColor = layout.base_color;
            if(/^#[0-9a-f]{6}$/i.test(this.color))  {
                assetColor = this.color;
            }
            let color = layout.professionals.c;
            if("asset" === color) color = assetColor;

            let fontFamily = "inherited";
            if(layout.professionals.ff) {
                switch(layout.professionals.ff) {
                    case "times":
                        fontFamily = "times";
                        break;

                    case "georgia":
                        fontFamily = "Georgia, sans-serif";
                        break;

                    case "sans-serif":
                        fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                        break;
                }
            }

            return {
                left: (layout.professionals.l * m.x) + "px",
                right: (layout.professionals.r * m.x) + "px",
                top: (layout.professionals.y * m.y) + "px",
                // height: (layout.professionals.h * m.y) + "px",
                color,
                // textTransform: "uppercase",
                // fontWeight: "bold",
                fontSize: fontSize+"em",
                lineHeight: "1em",
                fontFamily,
            }

        },

        projectsCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            if(!layout.projects) {
                return {
                    display: "none",
                }
            }

            let fontSize = 2;
            fontSize *= m.x;

            if(layout.projects.s) {
                fontSize *= layout.projects.s;
            }

            let assetColor = layout.base_color;
            if(/^#[0-9a-f]{6}$/i.test(this.color))  {
                assetColor = this.color;
            }
            let color = layout.projects.c;
            if("asset" === color) color = assetColor;

            let fontFamily = "inherited";
            if(layout.projects.ff) {
                switch(layout.projects.ff) {
                    case "times":
                        fontFamily = "times";
                        break;

                    case "georgia":
                        fontFamily = "Georgia, sans-serif";
                        break;

                    case "sans-serif":
                        fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                        break;
                }
            }

            return {
                left: (layout.projects.l * m.x) + "px",
                right: (layout.projects.r * m.x) + "px",
                top: (layout.projects.y * m.y) + "px",
                // height: (layout.professionals.h * m.y) + "px",
                color,
                // textTransform: "uppercase",
                // fontWeight: "bold",
                fontSize: fontSize+"em",
                lineHeight: "1em",
                fontFamily,
            }

        },

        headlineCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            let fontSize = 3.95;

            fontSize *= m.x;

            if(layout.headline.s) {
                fontSize *= layout.headline.s;
            }

            if(this.headline.length > 40) {
                fontSize *= 0.85;
            }


            let lineHeight = 1.05;
            if(layout.headline.lh) {
                lineHeight = layout.headline.lh;
            }

            let fontFamily = "times";
            if(layout.headline.ff) {
                switch(layout.headline.ff) {
                    case "sans-serif":
                        fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                        break;
                }
            }

            let color = layout.headline.c;
            if("asset" === color) {
                color = this.color;
            }

            return {
                color,
                fontFamily: fontFamily,
                fontSize: fontSize + "em",
                lineHeight: lineHeight + "em",
                left: (layout.headline.l * m.x) + "px",
                right: (layout.headline.r * m.x) + "px",
                top: (layout.headline.y * m.y) + "px",
            }

        },

        introCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            let fontSize = 3.95;
            let top = layout.intro.y * 0.7;
            
            fontSize *= m.x;

            if(layout.intro.s) {
                fontSize *= layout.intro.s;
            }

            if(this.intro.length > 40) {
                fontSize *= 0.85;
            } else if (this.intro.length > 70) {
                top = layout.intro.y * 0.65;
            }


            let lineHeight = 1.05;
            if(layout.intro.lh) {
                lineHeight = layout.intro.lh;
            }


            let fontFamily = "times";
            if(layout.intro.ff) {
                switch(layout.intro.ff) {
                    case "sans-serif":
                        fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                        break;
                }
            }

            return {
                color: layout.intro.c,
                fontFamily: fontFamily,
                fontSize: fontSize + "em",
                lineHeight: lineHeight + "em",
                left: (layout.intro.l * m.x) + "px",
                right: (layout.intro.r * m.x) + "px",
                top: (top) + "px",
            }

        },

        bodyTextCss() {

            const layout = this.layout;
            const m = this.previewMultipliers;

            const dummy = this.headlineFlag;

            let bodyText = {
                display: "none",
            }

            if(layout.bodyText.position !== "none") {
                let bTop;
                if("absolute" === layout.bodyText.position) {
                    bTop = layout.bodyText.y * m.y;
                } else {
                    bTop = (layout.headline.y + layout.bodyText.p) * m.y + this.headlineClientHeight;                    Promise
                }

                let fontSize = 35880.0;
                fontSize *= m.x;
                if(layout.bodyText.s) {
                    fontSize *= layout.bodyText.s;
                }

                if(this.bodyText.length > 40) {
                    fontSize *= 0.85;
                }

                fontSize /= 1000;

                let fontFamily = "times";
                if(layout.bodyText.ff) {
                    switch(layout.bodyText.ff) {
                        case "sans-serif":
                            fontFamily = 'SalesforceSansRegular, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
                            break;
                    }
                }

                let lineHeight = 1.2;
                if(layout.bodyText.lh) {
                    lineHeight = layout.bodyText.lh;
                }

                bodyText = {
                    color: layout.bodyText.c,
                    fontFamily: fontFamily,
                    fontSize: fontSize + "px",
                    lineHeight: lineHeight + "em",
                    left: (layout.bodyText.l * m.x) + "px",
                    right: (layout.bodyText.r * m.x) + "px",
                    top: bTop + "px",
                }
            }

            return bodyText;
        },

        overlayCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            if(!layout.overlay) {
                return {display: 'none', };
            }

            return {
                left: (layout.overlay.x * m.y) + "px",
                top: (layout.overlay.y * m.y) + "px",
                width: (layout.overlay.w * m.x)+"px",
                height: (layout.overlay.h * m.y)+"px",
                backgroundImage: "url(" + this.overlayUrl + ")",
            };
        },

        layer2Css() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            if(!layout.overlay || !layout.overlay.layer2) {
                return {display: 'none', };
            }

            return {
                left: 0,
                top: 0,
                width: (layout.overlay.w * m.x)+"px",
                height: (layout.overlay.h * m.y)+"px",
                backgroundImage: "url(" + this.layer2Url + ")",
            };
        },

    },

    methods: {
        downloadWithCSS() {

          /** WITH CSS */
           domtoimage
           .toPng(this.$refs.content)
           .then(function(dataUrl) {
             var img = new Image();
             img.src = dataUrl;
             const doc = new jsPDF("p", "pt", "a4");
             doc.addImage(img, "JPEG", 20, 20);
             const date = new Date();
             const filename =
               "Page-Preview-" +
               date.getFullYear() +
               ("0" + (date.getMonth() + 1)).slice(-2) +
               ("0" + date.getDate()).slice(-2) +
               ("0" + date.getHours()).slice(-2) +
               ("0" + date.getMinutes()).slice(-2) +
               ("0" + date.getSeconds()).slice(-2) +
               ".pdf";
             doc.save(filename);
           })
           .catch(function(error) {
             console.error("oops, something went wrong!", error);
           });
        },
    },

    watch: {
        headline(v) {
            this.$nextTick(() => {
                this.headlineFlag = !this.headlineFlag;
            });
        }
    }
}
</script>

<style scoped>
.preview {
    position: relative;
}

.preview-outer {
    position: relative;
    /*padding: 45px 12px 62px 12px;*/
    /*height:100%;*/
    /*width: 100%;*/
    background-repeat: no-repeat;
    background-size: contain;
}

.preview-inner {
    position: relative;
    height:100%;
    width: 100%;
}

/*
.preview-inner .logo-container {
    width: 100%;
    height: 100%;
    text-align: center;
}
*/

.preview-inner  img {
    max-width: 100%;
    max-height: 100%;
    display: inline;
}

.logo-area {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: left;
    z-index: 4;
}

.cta {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: left;
    z-index: 5;
}

.professionals {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: left;
    z-index: 5;
}

.projects {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: left;
    z-index: 5;
}

.headline {
    position:absolute;
    /*display: flex;*/
    /*align-items: flex-start;*/
    justify-content: left;
    z-index: 5;
}

.intro {
    position:absolute;
    /*display: flex;*/
    /*align-items: flex-start;*/
    justify-content: left;
    z-index: 5;
}

.body-text {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: left;
    z-index: 5;
}

.image-overlay {
    position:absolute;
    color: blue;
    font-size: 3em;
    background-position: center;
    z-index: 1;
    background-size: cover;
}

.image-overlay-layer2 {
    position:absolute;
    color: blue;
    font-size: 3em;
    background-position: center;
    background-size: cover;
    z-index: 2;
}


.preview-inner.Blue .logo-area img {
    -webkit-filter: url(#logo_filter);
    filter:  url(#logo_filter);
}

.preview-inner.Blue .image-overlay {
    -webkit-filter: url(#logo_filter);
    filter:  url(#logo_filter);
}

</style>
