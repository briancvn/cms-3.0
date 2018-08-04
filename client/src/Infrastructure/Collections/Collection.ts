interface SubArray<T> extends Array<T> {}
interface SubArrayConstructor {
    new<T>(): SubArray<T>;
    readonly prototype: SubArray<any>;
}

declare const SubArray: SubArrayConstructor;

export class Collection<T> extends SubArray<T> {
    remove(item: T): void {
        this.splice(this.findIndex(x => x === item), 1);
    }

    clear(): void {
        this.splice(0, this.length);
    }

    reset(items?: T[]): void {
        this.splice(0, this.length, ...items);
    }
}
