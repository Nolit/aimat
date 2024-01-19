export interface User {
    id: number;
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface Task {
    id: number;
    user_id: number;
    goal_id: number;
    title: string;
    note: string;
    date: string;
    is_achieved: boolean;
}

