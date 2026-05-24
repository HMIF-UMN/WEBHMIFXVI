import { Head } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import WorkProgramIntroduction from '@/components/WorkProgram/Introduction';
import ProgramLists from '@/components/WorkProgram/ProgramList';
import type { WorkProgram } from '@/types';

interface Props {
    wordingan?: string;
    work_programs: WorkProgram[];
}

export default function WorkProgram({ wordingan, work_programs }: Props) {
    return (
        <AppLayout>
            <Head title="Work Program" />
            <main className="relative min-h-screen bg-[#010511] flex flex-col items-center justify-start overflow-x-hidden selection:bg-[#149ED8]/30">
                <WorkProgramIntroduction wordingan={wordingan} />
                <div className="w-full relative z-10">
                    <ProgramLists work_programs={work_programs} />
                </div>
            </main>
        </AppLayout>
    );
}
