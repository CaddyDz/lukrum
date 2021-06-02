<template>
    <div class="mt-6 mb-6 flex justify-center">
        <div class="preview flex justify-center" v-if="layout" :style="{height: height + 'px', width: width + 'px', }">
            <div class="preview-outer" :style="previewOuterCss">
                <div class="preview-inner">
                    <!--                                :style="{backgroundImage: assetColor ? 'linear-gradient(white, ' + assetColor.css + ')' : 'grey'}"-->
                    <div class="logo-area" :style="logoAreaCss">
                        <!--                                    <div class="logo-container">-->
                        <img :src="logo" alt="Partner Logo" v-if="logo" />
                        <!--                                    </div>-->
                    </div>
                    <div class="logo2-area" :style="logo2AreaCss">
                        <!--                                    <div class="logo-container">-->
                        <img :src="logo" alt="Partner Logo" v-if="logo" />
                        <!--                                    </div>-->
                    </div>

                    <div class="headline" ref="headlineDiv" :style="headlineCss" v-html="headlinePrepared"></div>
                    <div class="intro" ref="introDiv" :style="introCss" v-html="intro"></div>
                    <div class="body-text" :style="bodyTextCss" v-text="bodyText"></div>
                    <div class="cta" :style="ctaCss" v-text="cta"></div>
                    <div class="footer" :style="footerCss" v-text="footer"></div>
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
    name: "CibPagePreview",
    props: ["layout", "logo", "headline", "intro", "bodyText", "cta", "width", "height", "footer", ],

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
            // if(/^#[0-9a-f]{6}$/i.test(this.color))  {
            //     assetColor = this.color;
            // }

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
        logo2AreaCss() {
            const layout = this.layout;

            if(!layout.logo2) return {display: "none"};

            const m = this.previewMultipliers;
            return {
                left: (layout.logo2.x * m.x) + 'px',
                top: (layout.logo2.y * m.y) + 'px',

                width: (layout.logo2.w * m.x) + 'px',
                height: (layout.logo2.h * m.y) + 'px',
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
                fontSize *= 0.7;
            } else if(this.cta.length >= 22) {
                fontSize *= 0.8;
            } else if(this.cta.length >= 18) {
                fontSize *= 0.9;
            }

            let assetColor = layout.base_color;
            // if(/^#[0-9a-f]{6}$/i.test(this.color))  {
            //     assetColor = this.color;
            // }
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

        footerCss() {
            const layout = this.layout;

            if(!layout.footer || !this.footer) return {display: "none"};

            const m = this.previewMultipliers;

            let fontSize = 0.74;
            fontSize *= m.x;

            if(layout.footer.s) {
                fontSize *= layout.footer.s;
            }

            let assetColor = layout.base_color;
            // if(/^#[0-9a-f]{6}$/i.test(this.color))  {
            //     assetColor = this.color;
            // }
            let color = layout.footer.c;
            if("asset" === color) color = assetColor;


            return {
                left: (layout.footer.l * m.x) + "px",
                right: (layout.footer.r * m.x) + "px",
                top: (layout.footer.y * m.y) + "px",
                height: (layout.footer.h * m.y) + "px",
                color,
                fontSize: fontSize+"em",
                lineHeight: "1em",
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

            return {
                color: layout.headline.c,
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

            fontSize *= m.x;

            if(layout.intro.s) {
                fontSize *= layout.intro.s;
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
                top: (layout.intro.y * m.y) + "px",
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
}

.logo-area img {
    -webkit-filter: url(#logo_filter);
    filter:  url(#logo_filter);
}

.logo2-area {
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

.footer {
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

</style>
