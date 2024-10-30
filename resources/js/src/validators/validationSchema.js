import {object, string} from 'yup';

export const zohoSchema = object({
    deal_name: string()
        .required(),
    stage: string()
        .required(),
    account_name: string()
        .required(),
    website: string()
        .required(),
    phone: string()
        .required(),
});
