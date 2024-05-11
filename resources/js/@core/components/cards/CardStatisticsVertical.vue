<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  image: {
    type: String,
    required: true,
  },
  stats: {
    type: String,
    required: true,
  },
  change: {
    type: Number,
    required: true,
  },
})

const isPositive = controlledComputed(() => props.change, () => Math.sign(props.change) === 1)
</script>

<template>
  <VCard>
    <VCardText>
      
      <h5 class="text-h5 text-no-wrap mb-3 color-green">
        {{ props.stats }}
      </h5>
      <p class="mb-1">
        {{ props.title }}
      </p>
      <span
        :class="isPositive ? 'text-success' : 'text-error'"
        class="d-flex align-center gap-1 text-sm"
      >
      </span>
    </VCardText>
  </VCard>
</template>
