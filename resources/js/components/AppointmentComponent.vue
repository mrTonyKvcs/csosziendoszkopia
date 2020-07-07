<template>
    <div class="col-md-6">
            <div class="w-100">
                <select class="mt-3 w-100" @change="getDoctors($event)" id="appointment" name="appointment" required>
                    <option value="" selected>Válasszon vizsgálatot</option>
                    <option v-for="examination in medicalExaminations" :value="examination.id">{{ examination.name }}</option>
                </select>

                <select v-if="doctors" class="mt-3 w-100" @change="getConsultations($event)" id="appointment" name="doctor" required>
                    <option value="" selected>Válasszon orvost</option>
                    <option v-for="doctor in doctors" :value="doctor.id">{{ doctor.name }}</option>
                </select>

                <div class="mt-5 mb-4 info">
                    <p v-if="info">A kiválasztott vizsgálat ideje: <strong>{{ info.minutes }} </strong> perc</p>
                    <p v-if="info">A kiválasztott vizsgálat díja: <strong> {{ info.price | currency }} </strong> Ft</p>
                </div>

                <select v-if="consultations" class="my-3 w-100" @change="getAppointments($event)" id="consultations" name="consultation" required>
                    <option value="" selected>Válasszon napot</option>
                    <option v-for="consultation in consultations" :value="consultation.id">{{ consultation.day + ' | ' + consultation.open + ' - ' + consultation.close}}</option>
                    <button type="submit" class="btn w-100">Fizetés</button>
                </select>

                <!--<select v-if="consultations" class="my-3 w-100" @change="" id="consultations" name="time" required>-->
                    <!--<option value="" selected>Válasszon napot</option>-->
                    <!--<option v-for="consultation in consultations" :value="consultation.id">{{  }}</option>-->
                <!--</select>-->
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
                consultations: null,
                consultationId: null,
                medicalExaminations: this.examinations,
                errors: null,
                examination: null,
                info: null
            }
        },
        filters: {
            currency: function (value) {
                return parseFloat(value).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        methods: {
            getDoctors(examination) {
                this.examination = null
                this.doctors = null
                this.consultations = null
                this.info = null
                this.consultationId = null

                this.examination = examination.target.value

                axios.post('/api/doctors/', {
                    id: this.examination
                })
                    .then(response => {
                        this.doctors = response.data
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },

            getConsultations(doctor) {
                this.consultations = null
                this.consultationId = null
                this.info = null

                axios.post('/api/consultations/', {
                    id: doctor.target.value,
                    examination: this.examination
                })
                    .then(response => {
                        this.info = response.data.info
                        this.consultations = response.data.days
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },

            getAppointments(consultation) {
                this.consultationId = consultation

                console.log(consultation.target.value)

                axios.post('/api/appointments/', {
                    consultation_id: consultation.target.value,
                })
                    .then(response => {
                        console.log(response.data)
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },

            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>

<style>
    select {
        padding: 15px;
        font-size: 18px;
    }

    .info {
        font-size: 18px;
    }
</style>
