export const useRemoveEmptyFields = (data: any): any => {
    Object.keys(data).forEach(key => {
        if (data[key] === '') {
            delete data[key];
        }
    });

    return data;
};
