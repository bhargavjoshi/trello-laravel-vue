<template>
    <div id="app">
        <header>
            <h3 class="heading">Trello</h3>
            <a :href="downloadUrl()">Download Dump</a>

        </header>
        <section>
            <Column
                :key="column.id"
                v-for="column in columns"
                :column="column"
                :onAddNewCard="onAddNewCard"
                :deleteColumn="deleteColumn"
                :syncListItems="syncListItems"
            />
            <AddColumn :onAddNewColumn="onAddNewColumn"/>
        </section>
    </div>
</template>

<script>
import EventBus from '../Util/EventBus'
import Column from "../components/Column";
import AddColumn from "../components/AddColumn";

export default {
    name: 'app',
    components: {Column, AddColumn},
    data: function () {
        return {
            columns: []
        }
    },
    methods: {
        async onAddNewColumn(title) {
            console.log('new card added', 'Title:', title);
            try {
                let response = await axios.post('/api/columns', {
                    title: title,
                    sequence: this.columns.length + 1
                })

                // Fetch the latest state again.
                this.fetchAppState();
            } catch (error) {
                alert('Error Adding Columns, Please try again.');
            }
        },
        async onAddNewCard(columnId, cardTitle) {
            // Get column with this columnId
            let column = this.columns.find(column => column.id == columnId);
            console.log('column', column);
            try {
                let response = await axios.post('/api/cards', {
                    title: cardTitle,
                    column_id: columnId,
                    sequence: column.cards.length + 1
                })

                // Fetch the latest state again.
                this.fetchAppState();
            } catch (error) {
                console.log(error);
                alert('Error Adding Columns, Please try again.');
            }
        },
        async deleteColumn(columnId) {
            try{
                let response = await axios.delete('/api/columns', {
                    data: {
                        column_id: columnId,
                    }
                });

                // Fetch the latest state again.
                this.fetchAppState();
            } catch (error) {
                console.log('error', error);
                alert('Something went wrong deleting the column.');
            }
        },
        fetchAppState(){
            axios
                .get('/api/columns')
                .then(response => (this.columns = response.data))
                .catch((error) => {
                    alert('error fetching columns')
                });
        },
        async syncListItems(){
            // Patch cards/order
            try {
                let response = await axios.patch('/api/cards/order', {
                    columns: this.columns
                });
                // Fetch Latest App State
                this.fetchAppState();
            } catch (error) {
                console.log(error);
                alert('Error Syncing, Please try again.');
            }
        },
        downloadUrl(row){
            return window.location.origin + '/api/download-db-dump';
        },
    },
    mounted() {
        // Call Api to get the columns and card in it.
        this.fetchAppState();

        // Listen for app state update.
        EventBus.$on('UPDATE_APP_STATE', () => {
            this.fetchAppState();
        })
    }
};
</script>

<style scoped lang="scss">
header {
    text-align: center;
    background-color: #f4993e;
    overflow: hidden;
    width: 100%;
    height: 28px;
}

.heading {
    display: inline-block;
    text-align: center;
    font-weight: 400;
    color: white;
}

section {
    height: calc(100vh - 48px);
    white-space: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    background-color: #0078be;
    padding: 10px;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
}
</style>
