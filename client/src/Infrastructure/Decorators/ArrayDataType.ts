import { ɵangular_packages_core_core_b as makePropDecorator } from '@angular/core';

import { DataType, DataTypeDecorator } from './DataType';

export interface ArrayDataTypeDecorator extends DataTypeDecorator {}

export const ArrayDataType: ArrayDataTypeDecorator = makePropDecorator('ArrayDataType',
    (selector: any, data: any) => ({selector, first: true, isViewQuery: true, descendants: true, ...data}));

export interface ArrayDataType extends DataType {}
