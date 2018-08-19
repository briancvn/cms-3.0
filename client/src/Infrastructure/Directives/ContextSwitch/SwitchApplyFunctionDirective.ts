import { Directive, Input } from '@angular/core';
import { Observable } from 'rxjs';

import { BasicSwitchValue, SwitchValue } from '../../Models/ContextSwitch/SwitchValue';
import { ParentInjectorResolver } from '../../Services/ParentInjectorResolver';
import { SwitchSelectorBase } from './SwitchSelectorBase';
import { switchValueProvider } from './SwitchValueProvider';

@Directive({
    selector: '[switchApplyFunction]',
    providers: [switchValueProvider, ParentInjectorResolver]
})
export class SwitchApplyFunctionDirective extends SwitchSelectorBase {
    // instead of using an opterator here, it would be more flexible to use a lamda function, but
    // sadly, that is not yet possible with angular. See: https://github.com/angular/angular/issues/14129
    // if that is implemented in angular we can refactor this to support lamda functions.
    @Input() operator: string;
    // tslint:disable-next-line:no-input-rename
    @Input('switchApplyFunction') value: BasicSwitchValue;

    constructor(switchValue: SwitchValue) {
        super(switchValue);
    }

    protected calculateSwitchValue(): Observable<BasicSwitchValue> {
        const parentSwitchValue = this.switchValue.findParentValueForContext(this.context);
        if (parentSwitchValue) {
            return parentSwitchValue
                .combineLatest(this.valuePropagator, this.createCombinationFunction());
        } else {
            throw new Error('switch apply function needs a parent switch value to combine with, but no value was found.');
        }
    }

    private createCombinationFunction(): (parent: BasicSwitchValue, current: BasicSwitchValue) => BasicSwitchValue {
        if (this.operator === 'or') {
            return (parent, current) => parent || current;
        } else if (this.operator === 'and') {
            return (parent, current) => parent && current;
        } else {
            throw new Error(`Unknown operator: ${this.operator}`);
        }
    }

    protected get inputValue(): BasicSwitchValue {
        return this.value;
    }
}
