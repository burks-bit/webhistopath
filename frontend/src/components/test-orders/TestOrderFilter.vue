<template>
    <v-form ref="filterForm" v-model="validForm">
        <v-row>
            <v-col cols="12" md="2">
                <v-text-field
                    v-model="filterTestorderForm.last_name"
                    label="Patient's Last Name"
                    variant="outlined"
                    density="compact"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="2">
                <v-select
                    v-model="filterTestorderForm.department"
                    label="Department"
                    item-title="department"
                    item-value="abbr"
                    :items="departments"
                    variant="outlined"
                    density="compact"
                ></v-select>
            </v-col>
            <v-col cols="12" md="2">
                <v-select
                    v-model="filterTestorderForm.malignancy_type"
                    label="Malignancy Type"
                    item-title="malignant"
                    item-value="abbr"
                    :items="malignants"
                    variant="outlined"
                    density="compact"
                ></v-select>
            </v-col>
            <v-col cols="12" md="2">
                <v-text-field
                    v-model="filterTestorderForm.start_date"
                    label="Start Requested Date"
                    type="date"
                    variant="outlined"
                    density="compact"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="2">
                <v-text-field
                    v-model="filterTestorderForm.end_date"
                    label="End Requested Date"
                    type="date"
                    variant="outlined"
                    density="compact"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="2">
                <v-btn
                    class="text-capitalize"
                    color="primary"  
                    @click="submitFilter"
                >
                    <i class="fa fa-filter me-1"></i> Filter
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>

<script setup>
    import {ref} from 'vue'
    const emit = defineEmits(['submit-filter'])

    const validForm = ref(false)
    const filterTestorderForm = ref({
        department: '',
        malignancy_type: '',
        start_date: '',
        end_date: '',
    })

    const departments = [
        { department: 'None', abbr: 'None' },
        { department: 'Surgical', abbr: '5' },
        { department: 'Cytology', abbr: '6' },
        { department: 'Papsmear', abbr: '7' },
        { department: 'Immunohistochemistry', abbr: '8' },
    ]

    const malignants = [
        { malignant: 'None', abbr: 'None' },
        { malignant: 'Malignant', abbr: '11' },
        { malignant: 'Non-Malignant', abbr: '12' },
    ]

    const submitFilter = () => {
        // const isEmpty = Object.values(filterTestorderForm.value).every(value => !value.trim());
        // if (isEmpty) {
        //     alert('All fields are empty!');
        //     return;
        // }
        emit('submit-filter', { ...filterTestorderForm.value })
    }
</script>