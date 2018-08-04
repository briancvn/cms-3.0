import { Type, ɵangular_packages_core_core_b as makePropDecorator } from '@angular/core';

export interface DataTypeDecorator {
    (type: Type<any>): any;
    new (type: Type<any>): any;
}

export interface DataType {
    type: Type<any>;
}

export const DataType: DataTypeDecorator = makePropDecorator('DataType',
    (selector: any, data: any) => ({selector, first: true, isViewQuery: true, descendants: true, ...data}));

