<template>
    <div class="mt-6 mb-6 flex justify-center">
        <div class="preview flex justify-center" v-if="layout" :style="{height: height + 'px', width: width + 'px', }">
            <div class="preview-outer" :style="previewOuterCss">
                <div class="preview-inner" :class="layout.code">
                    <!--                                :style="{backgroundImage: assetColor ? 'linear-gradient(white, ' + assetColor.css + ')' : 'grey'}"-->
                    <div class="logo-area" :style="logoAreaCss">
                        <!--                                    <div class="logo-container">-->
                        <img :src="logo" alt="Partner Logo" v-if="logo" />
                        <!--                                    </div>-->
                    </div>

                    <div class="headline" ref="headlineDiv" :style="headlineCss" v-html="headlinePrepared"></div>
                    <div class="body-text" :style="bodyTextCss" v-text="bodyText"></div>
                    <div class="cta" :style="ctaCss" v-text="cta"></div>

                    <div class="image-overlay" v-if="!!layout.overlay" :style="overlayCss">
                        <div class="image-overlay-layer2" v-if="!!layout.overlay.layer2" :style="layer2Css"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
<!--        <h1 v-text="color"></h1>-->

<!--        <h1 v-text="bgImage"></h1>-->
<!--        <img width="100" :src="bgImage" />-->

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
// Create a Cloudinary instance and set your cloud name.
const cld = new Cloudinary({
    cloud: {
        cloudName: 'pierry'
    }
});

// cld.image returns a CloudinaryImage with the configuration set.

// This returns: https://res.cloudinary.com/demo/image/upload/sample

export default {
    name: "BannerPreview",
    props: ["layout", "logo", "color", "headline", "bodyText", "cta", "width", "height", "overlay", ],

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
            if(this.cta.length > 22) {
                fontSize *= 0.8;
            } else if(this.cta.length > 18) {
                fontSize *= 0.9;
            }

            let assetColor = layout.base_color;
            if(/^#[0-9a-f]{6}$/i.test(this.color))  {
                assetColor = this.color;
            }
            let ctaColor = layout.cta.c;
            if("asset" === ctaColor) ctaColor = assetColor;


            return {
                left: (layout.cta.l * m.x) + "px",
                right: (layout.cta.r * m.x) + "px",
                top: (layout.cta.y * m.y) + "px",
                height: (layout.cta.h * m.y) + "px",
                color: ctaColor,
                textTransform: "uppercase",
                fontWeight: "bold",
                fontSize: fontSize+"em",
                lineHeight: "1em",
            }

        },

        headlineCss() {
            const layout = this.layout;
            const m = this.previewMultipliers;

            let fontSize = 3.24;

            fontSize *= m.x;

            if(layout.headline.s) {
                fontSize *= layout.headline.s;
            }

            let len = 0;
            if(this.headline) {
                if("string" === typeof this.headline) {
                    len = this.headline.length;
                } else if(this.headline.strip) {
                    len = this.headline.strip.length;
                }
            }

            if(len > 50) {
                fontSize *= 0.8;
            } else if(len > 40) {
                fontSize *= 0.85;
            } else if (len > 30) {
                fontSize *= 0.9;
            }

            let lineHeight = 1.05;
            if(layout.headline.lh) {
                lineHeight = layout.headline.lh;
            }

            return {
                color: layout.headline.c,
                fontFamily: "times",
                fontSize: fontSize + "em",
                lineHeight: lineHeight + "em",
                left: (layout.headline.l * m.x) + "px",
                right: (layout.headline.r * m.x) + "px",
                top: (layout.headline.y * m.y) + "px",
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
                let bTop = (layout.headline.y + layout.bodyText.p) * m.y + this.headlineClientHeight;

                let fontSize = 27000.0;
                fontSize *= m.x;
                if(layout.bodyText.s) {
                    fontSize *= layout.bodyText.s;
                }

                const len = this.bodyText ? this.bodyText.length : 0;
                if(len > 63) {
                    fontSize *= 0.7;
                } else if(len > 58) {
                    fontSize *= 0.8;
                } else if(len > 53) {
                    fontSize *= 0.85;
                } else if(len > 48) {
                    fontSize *= 0.9;
                }

                fontSize /= 1000;

                let fontFamily = "times";
                if(layout.bodyText.ff) {
                    switch(layout.bodyText.ff) {
                        case "sans-serif":
                            fontFamily = 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
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
        }
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
    align-items: center;
    justify-content: center;
}

.cta {
    position:absolute;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    z-index: 5;
}

.headline {
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
