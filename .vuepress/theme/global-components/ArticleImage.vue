<template>
    <div class="bleed">
        <img :src="url">
    </div>
</template>

<script>
export default {
    props: {
        url: { required: true },
    }
}
</script>
