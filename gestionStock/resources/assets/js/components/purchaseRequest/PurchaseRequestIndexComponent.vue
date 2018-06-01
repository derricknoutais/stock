<template>
    <div>
        <div class="text-center my-5">
            <a name="" id="" class="btn btn-danger" href="/home" role="button">Retour</a>
            <a name="" id="" class="btn btn-primary" href="/demande-achat/nouveau" role="button">Créer Nouvelle Demande d'Achat</a>

        </div>

        <h1 class="my-5">Dossier Demande d'Achats</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Libellé</th>
                    <th>État</th>
                    <th scope="col">Émis Par</th>
                    <th scope="col">Date De Création</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request of requests">
                    <td>
                        <a :href="/demande-achat/ + request.id" v-if="request.local_id">
                            ACL00{{request.local_id}}
                        </a>
                        <a :href="/demande-achat/ + request.id" v-else>
                            ACE00{{request.international_id}}
                        </a>
                    </td>
                    <td>{{request.object}}</td>
                    <td>
                        <span v-if="request.state == 0">En cours ...</span>
                        <span v-if="request.state == 1">Attente Validation (0/2)</span>
                        <span v-if="request.state == 2">Attente Validation (1/2)</span>
                        <span v-if="request.state == 3">Validée</span>
                        <span v-if="request.state == 4">Stock Reçu</span> 
                        <span v-if="request.state == -1">Annulé</span>
                    </td>
                    <td>{{request.user.name}}</td>
                    <td>{{(request.created_at)}}</td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <pagination :data="links" :limit="2" @pagination-change-page="getResults"></pagination>
        </div>
        
        <!-- <p class="text-center">{{$links}}</p> -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                requests : {},
                links: {},
            }
        },
        mounted() {
            this.getResults();
        },

        methods: {
            getResults(page = 1) {
                axios.get('/api/demande-achat?page=' + page)
                    .then(response => {
                        this.requests = response.data.data
                        this.links = response.data;
                    });
            }
        }
    }
</script>
