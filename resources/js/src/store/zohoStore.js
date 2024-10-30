import {defineStore} from "pinia";
import api from "../api/zohoApi.js";

export const zohoStore = defineStore('zohoStore', {
    state: () => ({
        token: localStorage.getItem('token') || null,
        loader: false,
        error: '',
    }),
    actions: {
        async refreshToken() {
            try {
                const response = await api.post('http://127.0.0.1:8000/api/refresh');
                this.token = response.data.access_token;
                localStorage.setItem('token', this.token);
            } catch (error) {
                console.log(error.response);
            }
        },
        async createRecord($data) {
            this.loader = true;
            this.error = '';
            try {
                const response = await api.post('http://127.0.0.1:8000/api/record', $data);
            } catch (error) {
                this.error = error.response.data.message;
                throw error;
            } finally {
                this.loader = false;
            }
        }
    }
});
