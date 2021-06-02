<template>
    <div class="back-button-wrapper">
        <a href="#" @click.prevent="$emit('linkClicked')">
            <svg width="11px" height="17px" viewBox="0 0 11 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Back/active" transform="translate(1.000000, 1.000000)" class="button-stroke"  stroke-width="3">
<!--                        stroke="#0176D3"-->
                        <polyline id="Path-3" points="9 0.233398438 2 7.23339844 9 14.2333984"></polyline>
                    </g>
                </g>
            </svg>
            <span>BACK</span>
        </a>
    </div>
</template>

<script>
export default {
    name: "BackButton",
    emits: ["linkClicked"],
}
</script>

<style scoped>

</style>
