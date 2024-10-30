import axios from "axios";
import {zohoStore} from "../store/zohoStore.js";

const api = axios.create();

api.interceptors.request.use((config) => {
    const store = zohoStore();
    const token = store.token;

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

api.interceptors.response.use(
    (response) => response,
    async (error) => {
        const tokenStore = zohoStore();

        if (error.response.status === 500) {
            try {
                await tokenStore.refreshToken();
                const newToken = tokenStore.token;
                error.config.headers['Authorization'] = `Bearer ${newToken}`;
                return api.request(error.config);
            } catch (error) {
                throw error;
            }
        }
        throw error;
    }
);
export default api;
