// ES7 - needs to be compiled down

class easyHTTP {
    // Make HTTP GET request
    async get(url) {
        const response = await fetch(url)

        const resData = await response.json()

        return resData
    }
    // Make HTTP POST request
    async post(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        })

        const resData = await response.json()
        return resData
    }

    // Make HTTP POST request with files
    async postWithFile(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        })

        const resData = await response.json()
        return resData
    }

    // Make an HTTP PUT request
    async put(url, data) {
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        })

        const resData = await response.json()
        return resData
    }
    // Make an HTTP DELETE request
    async delete(url) {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-type': 'application/json'
            }
        })
        const resData = await 'Resource Deleted...'
        return resData
    }
}