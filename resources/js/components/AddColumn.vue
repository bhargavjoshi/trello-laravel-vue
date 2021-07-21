<template>
    <div class="column">
        <div class="card-input">
            <label>
                <input
                    type="text"
                    placeholder="+ Add new column"
                    class="card-input"
                    v-model="title"
                    v-on:keyup.enter="onEnter"
                >
            </label>
        </div>
    </div>
</template>

<script>
import Card from "./Card";
import draggable from "vuedraggable";

export default {
    props: ['onAddNewColumn'],
    name: 'Column',
    data: function () {
        return {
            title: ''
        }
    },
    methods: {
        onEnter: function() {
            if(this.title.length <1) {
                alert('Title Can\'t be empty.');
                return false;
            }
            this.onAddNewColumn(this.title)

            // Reset the title field.
            this.title = ''
        }
    }
};
</script>

<style scoped lang="scss">
.column {
    margin-right: 20px;
    background-color: #dbe0e7;
    min-width: 360px;
    //height: 95vh;
    max-height: 95vh;
    border-radius: 4px;
    overflow-y: scroll;
    padding: 0 10px;
    font-weight: 500;
}

.card-input {
    width: 96%;
    background-color: white;
    border-radius: 4px;
    font-size: 12px;
    outline: none;
    margin-top: 10px;
    margin-bottom: 10px;
    border: none;
}


</style>
