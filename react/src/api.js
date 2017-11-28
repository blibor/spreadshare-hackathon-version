// @flow
import fetchWrapper from "./lib/fetchWrapper";

const API_URL = "http://dev.spreadshare.co:81";

export const fetchDataApi = (method: string) =>
  fetchWrapper(`${API_URL}/api/v1/${method}`, {
    method: "GET"
  }).then(response => response.json());

export const saveDataApi = (method: string, body: Object) =>
  fetchWrapper(`${API_URL}/api/v1/${method}`, {
    method: "POST",
    body: JSON.stringify(body)
  }).then(response => response.json());
