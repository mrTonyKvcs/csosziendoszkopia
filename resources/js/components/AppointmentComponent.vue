<template>
    <div class="col-md-6">
        <h3>Időpontfoglalás és fizetés</h3>
        <p>Foglaljon időpontot az online konzultációra!</p>

            <div class="w-100">
                <select class="mt-3 w-100" @change="getDoctors($event)" id="appointment" name="appointment" required>
                    <option value="" selected>Válasszon vizsgálatot</option>
                    <option v-for="examination in medicalExaminations" :value="examination.id">{{ examination.name }}</option>
                </select>

                <select v-if="doctors" class="mt-3 w-100" @change="" id="appointment" name="appointment" required>
                    <option value="" selected>Válasszon orvost</option>
                    <option v-for="doctor in doctors" :value="doctor.slug">{{ doctor.name }}</option>
                </select>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['examinations'],
        data () {
            return {
                doctors: null,
                medicalExaminations: this.examinations,
                errors: null
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getDoctors(examination) {
                this.doctors = null

                axios.post('/api/doctors/' + examination.target.value)
                    .then(response => {
                        this.doctors = response.data
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            }
        }
    }
</script>

<style>
    select {
        padding: 15px;
        font-size: 18px;
    }
</style>
