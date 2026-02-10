export const API_BASE_URL: string = 'http://127.0.0.1:8000/api/v1';
let controller = new AbortController();
let signal = controller.signal;

const req = async (
    endpoint: string,
    method: string,
    params?: any,
    abortPreviewsRequest?: boolean,
    isFormData?: boolean,
) => {

    if (abortPreviewsRequest === true) {
        controller.abort();
        controller = new AbortController();
        signal = controller.signal;
    }

    const authToken = await getAuthTokenFromLocalStorage()

    // set headers
    const rHeaders = new Headers();
    rHeaders.append("Accept", "application/json");

    rHeaders.append("X-Vertical", "sports");
    rHeaders.append("X-secret", 'some-secret-key');

    if (!isFormData) { // if posting raw FormData (for example file upload) do not add content type
        rHeaders.append("Content-Type", "application/json");
    }

    if (authToken !== null) rHeaders.append("Authorization", "Bearer " + authToken)

    let rqBody: any;
    if (!isFormData) {
        rqBody = method !== "GET" ? JSON.stringify(params) : null;
    } else {
        rqBody = params
    }

    const requestOptions = {
        method: method,
        headers: rHeaders,
        body: rqBody,
        signal: (abortPreviewsRequest) ? signal : null
    };

    return new Promise((resolve, reject) => {

        fetch(API_BASE_URL + endpoint, requestOptions)
            .then(response => response.json())
            .then(result => resolve(result))
            .catch(error => reject(error));

    })

}

const getAuthTokenFromLocalStorage = () => {
    return new Promise((resolve) => {
        const isAuthTokenExists: string | null = localStorage.getItem("sessionToken")
        resolve(isAuthTokenExists)
    })
}

const deleteAuthTokenFromLocalStorage = () => {
    return new Promise((resolve) => {
        localStorage.removeItem("sessionToken")
        resolve(true)
    })
}

export default {req, getAuthTokenFromLocalStorage, deleteAuthTokenFromLocalStorage}
