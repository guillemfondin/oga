export interface Options {
  page?: number;
  perPage?: number;
  slug?: string;
  state?: string;
  search?: string;
  'createdAt[before]'?: string;
  'createdAt[strictly_before]'?: string;
  'createdAt[after]'?: string;
  'createdAt[strictly_after]'?: string;
}

export const toQuery = (options: Options = {}) => '?' + Object.keys(options).map(key => `${key}=${options[key]}&`).join('');
