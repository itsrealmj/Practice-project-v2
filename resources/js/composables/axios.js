import Axios from "axios";

export const axiosAuth = Axios.create({
    baseURL: window.location.origin,
});

axiosAuth.defaults.headers.common[
    "Authorization"
] = `Bearer ${localStorage.getItem("user_token")}`;

export const axios = Axios.create({
    baseURL: window.location.origin,
});
