<template>
    <div class="col-md-6">
            <div class="w-100">
                <select class="mt-3 w-100" @change="getDoctors($event)" id="appointment" name="medical_examination" required>
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
                    <p v-if="info">Ön 5000 Ft  előleg fizetésével tud időpontot foglalni on-line, mely összeg levonásra kerül a vizsgálat árából </p>
                </div>

                <select v-if="consultations" class="my-3 w-100" @change="getAppointments($event)" id="consultations" name="consultation" required>
                    <option value="" selected>Válasszon napot</option>
                    <option v-for="consultation in consultations" :value="consultation.id">{{ consultation.day + ' | ' + consultation.open + ' - ' + consultation.close}}</option>
                </select>

                <select v-if="appointments" class="my-3 w-100" @change="goPaying($event)" id="consultations" name="appointment_time" required>
                    <option value="" selected>Válasszon időpontot</option>
                    <option v-for="appointment in appointments" :value="[appointment.start_at, appointment.end_at]">{{ appointment.start_at + ' - ' + appointment.end_at }}</option>
                </select>

                <button v-if="paying" type="submit" class="btn w-100">Fizetés</button>
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
                examinationId: null,
                info: null,
                appointments: null,
                paying: false
            }
        },
        filters: {
            currency: function (value) {
                return parseFloat(value).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        methods: {
            getDoctors(examination) {
                this.examinationId = null
                this.doctors = null
                this.consultations = null
                this.info = null
                this.consultationId = null
                this.appointments = null

                this.examinationId = examination.target.value

                axios.post('/api/doctors/', {
                    id: this.examinationId
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
                    examination: this.examinationId
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
                this.appointments = null
                this.consultationId = consultation

                console.log(consultation.target.value)

                axios.post('/api/appointments/', {
                    consultation_id: consultation.target.value,
                    minutes: this.info.minutes
                })
                    .then(response => {
                        this.appointments = response.data
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },

            goPaying(appointment) {
                if (appointment.target.value) {
                    this.paying = true
                } else {
                    this.paying = false
                } 
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
