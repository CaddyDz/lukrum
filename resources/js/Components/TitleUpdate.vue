<template></template>

<script>

function titleUpdater() {
    const defaultTitle = document.title;
    return (title) => {
        document.title = defaultTitle + " | " + title;

        if(window.analytics) {
            window.analytics.page(title);
        }
    }
}

const updateTitle = titleUpdater();
export default {
    name: "TitleUpdate",
    props: ['title'],
    mounted() {
        updateTitle(this.title);
    }
}
</script>
