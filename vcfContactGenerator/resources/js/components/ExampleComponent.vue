<template>
    <div>
        <ul>
            <li v-for="user in users" :key="user.id">{{ user.first_name }}</li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            users: [],
        };
    },
    mounted() {
        axios
            .get("https://api.canzell.com/__public__/user-service/users?key=id")
            .then((response) => {
                this.users = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
