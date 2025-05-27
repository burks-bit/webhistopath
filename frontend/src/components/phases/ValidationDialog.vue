<template>
    <v-dialog :model-value="visible" @update:model-value="emit('update:visible', $event)" max-width="600">
        <v-card>
        <v-card-title class="text-h6">Validation - {{ order.specimen_id }}</v-card-title>
        <v-card-text>
            <!-- Your Grossing Phase Form Here -->
            <p>Perform Validation phase actions for order ID: {{ order.specimen_id }}</p>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="closeDialog"><i class="fa fa-cancel"></i> Cancel</v-btn>
            <v-btn color="primary" @click="save"><i class="fa fa-save"></i> Save</v-btn>
        </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
    const props = defineProps({
        visible: Boolean,
        order: Object,
    })
    const emit = defineEmits(['update:visible'])

    function closeDialog() {
        emit('update:visible', false)
    }

    function save() {
        console.log('Validating result for phase:', props.order)
        emit('update:visible', false)
    }
</script>
